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
        add_action( 'init', 'MHS_INTERVIEW_TASK_2\StoreCustomer::AddRole', 10 );

    }


    public static function AddRole()
    {

        // Check to see whether the role already exists
        $StoreCustomerExistingRole = get_role( 'mhs_interview_task_2_store_customer' );
        
        if( is_null($StoreCustomerExistingRole) )
        {
            // Add the "Store Customer" role if it is not defined
            add_role( 'mhs_interview_task_2_store_customer', 'Store Customer' );
        }
        else
        {
            
            // Get current capabilities of the  role
            $StoreCustomerExistingCapabilities = $StoreCustomerExistingRole->capabilities;
            
            // Iterate through the existing capabilities and remove them
            foreach ($StoreCustomerExistingCapabilities as $StoreCustomerExistingCapabilityName => $StoreCustomerExistingCapabilityValue)
            {

                $StoreCustomerExistingRole->remove_cap( $StoreCustomerExistingCapabilityName );

            }

        }

    }


}
