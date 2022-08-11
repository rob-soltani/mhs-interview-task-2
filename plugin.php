<?php

/**
 * Plugin Name: MHS Interview Task 2
 * Plugin URI: https://rob.soltani.io/
 * Description: A plugin that provides the following features: (1) Adds a new role "Store Customer", (2) Sets only the following ability for the "Store Customer" role: read, edit, and delete post, (3) Removes all items from admin area for the "Store Customer" role except for the dashboard, and (4) Removes plugins, appearance, users, and tools from the admin menu for the Administrator role. 
 * Version: 0.0.1
 * Requires at least: 6.0.1
 * Requires PHP: 7.4.26
 * Author: Rob Soltani
 * Author URI: https://rob.soltani.io
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: mhs_interview_task_2
 * Domain Path: /public/lang
 */

// Declare the MHS Interview Task 2 namespace
namespace MHS_INTERVIEW_TASK_2;

// Define a constant to hold the path to the root directory of the plugin
define('MHS_INTERVIEW_TASK_2_ROOT_DIR', plugin_dir_path(__FILE__));

// Import the store customer class
require_once MHS_INTERVIEW_TASK_2_ROOT_DIR . 'src/store-customer.php';

// Statically (singular instance) initiate the StoreCustomer class
StoreCustomer::Initiate();


// Import the admin menu modifier class
require_once MHS_INTERVIEW_TASK_2_ROOT_DIR . 'src/admin-menu-modifier.php';

// Statically (singular instance) initiate the AdminMenuModifier class
AdminMenuModifier::Initiate();