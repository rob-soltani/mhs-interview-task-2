<?php

// // Declare the MHS Interview Task 2 namespace
namespace MHS_INTERVIEW_TASK_2;

// Declare the StoreCustomer which performes the following:
//      (1) Adds a new role "Store Customer".
//      (2) Sets only the following ability for the "Store Customer" role: read, edit, and delete post,.
//      (3) Removes all items from admin area for the "Store Customer" role except for the dashboard.
class StoreCustomer
{

    // A function to initialize the StoreCustomer class functionalities
    public static function Initiate()
    {

        // Register the AddRole function with WordPress's initialization hook
        add_action('init', 'MHS_INTERVIEW_TASK_2\StoreCustomer::AddRole', 10);

        // Register the AddCapabilities function with WordPress's initialization hook
        add_action('init', 'MHS_INTERVIEW_TASK_2\StoreCustomer::AddCapabilities', 11);

        // Register the RemoveProfileAccess function with WordPress's admin_menu hook
        add_action('admin_menu', 'MHS_INTERVIEW_TASK_2\StoreCustomer::RemoveProfileAccess', 12);
    }


    public static function AddRole()
    {

        // Check to see whether the role already exists
        $StoreCustomerExistingRole = get_role('mhs_interview_task_2_store_customer');

        if (is_null($StoreCustomerExistingRole)) {
            // Add the "Store Customer" role if it is not defined
            add_role('mhs_interview_task_2_store_customer', 'Store Customer');
        } else {

            // Get current capabilities of the  role
            $StoreCustomerExistingCapabilities = $StoreCustomerExistingRole->capabilities;

            // Iterate through the existing capabilities and remove them
            foreach ($StoreCustomerExistingCapabilities as $StoreCustomerExistingCapabilityName => $StoreCustomerExistingCapabilityValue) {

                $StoreCustomerExistingRole->remove_cap($StoreCustomerExistingCapabilityName);
            }
        }
    }

    public static function AddCapabilities()
    {

        $StoreCustomerExistingRole = get_role('mhs_interview_task_2_store_customer');

        // Check to see whether the role exists
        if (!is_null($StoreCustomerExistingRole)) {
            $StoreCustomerExistingRole->add_cap('read', true);
            $StoreCustomerExistingRole->add_cap('edit_post', true);
            $StoreCustomerExistingRole->add_cap('delete_post', true);
        }
    }

    public static function RemoveProfileAccess()
    {

        // Get current logged in user
        $CurrentUser = wp_get_current_user();

        // Check if the current user if not null
        if (!is_null($CurrentUser)) {

            // Get current user roles
            $CurrentUser_Roles = (array) $CurrentUser->roles;

            // Check whether current user is a "Store Customer"
            $CurrentUser_IsStoreCustomer = in_array('mhs_interview_task_2_store_customer', $CurrentUser_Roles, true);

            if ($CurrentUser_IsStoreCustomer) {

                // Remove the link to the profile page from the admin menu.
                remove_menu_page('profile.php');

                // Prevent unauthorized access to the profile page
                if ( defined('IS_PROFILE_PAGE') && IS_PROFILE_PAGE === true )
                {
                    wp_die('You are not permitted to access the profile page. <a href="' . get_home_url() . '">Go to homepage<a>');
                                  
                }
            }
        }
    }
}
