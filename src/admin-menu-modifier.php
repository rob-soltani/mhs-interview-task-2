<?php

// // Declare the MHS Interview Task 2 namespace
namespace MHS_INTERVIEW_TASK_2;

// Declare the AdminMenuModifier which performes the following:
//      - Removes plugins, appearance, users, and tools from the admin menu for the Administrator role.

class AdminMenuModifier
{

    // A function to initialize the AdminMenuModifier class functionalities
    public static function Initiate()
    {

        // Register the RemoveUnwantedItemsFromAdminMenu function with WordPress's admin_menu hook
        add_action('admin_menu', 'MHS_INTERVIEW_TASK_2\AdminMenuModifier::RemoveUnwantedItemsFromAdminMenu');
    }

    private static function IsUserAdministrator()
    {

        // Get current logged in user
        $CurrentUser = wp_get_current_user();

        // Check if the current user if not null
        if (!is_null($CurrentUser)) {

            // Get current user roles
            $CurrentUser_Roles = (array) $CurrentUser->roles;

            // Check whether current user is a administrator
            $CurrentUser_IsAdministrator = in_array('administrator', $CurrentUser_Roles, true);

            if ($CurrentUser_IsAdministrator) {

                return true;

            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function RemoveUnwantedItemsFromAdminMenu()
    {

        // Remove items from menu only if the user is an administrator
        if (AdminMenuModifier::IsUserAdministrator()) {

            // Remove the Plugins link from the admin menu
            remove_menu_page('plugins.php');

            // Remove the Appearance link from the admin menu
            remove_menu_page('themes.php');
            
            // Remove the Users link from the admin menu
            remove_menu_page('users.php');

            // Remove the Tools link from the admin menu
            remove_menu_page( 'tools.php' );

        }
    }
}
