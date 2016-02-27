# Box API v.2 For PHP

This is a package can be used with PHP Project and especially integrate with Laravel. This package will serve latest Box API for App User for Enterprise to communicate server to server (eg. Uploading files to company Box behind the scene without ask grant to your web visitor, and Standard User for common user accesing their own Box account, and this will need grant access from their account.

## Installation on Laravel

To install into your project just run this command in terminal 

	composer require maengkom/boxapi
	
After download completed, you can add this to your app.php config file 

	Maengkom\Box\BoxAPIServiceProvider::class, // Laravel 5
	
	'Maengkom\Box\BoxAPIServiceProvider',      // Laravel 4
	
And if you want using Facade, you can use these two facade

	/* Laravel 5 */
	'BoxAU'     => Maengkom\Box\Facades\AppUserFacade::class,
	'BoxSU'     => Maengkom\Box\Facades\StandardUserFacade::class,

	/* Laravel 4 */
	'BoxAU'     => 'Maengkom\Box\Facades\AppUserFacade',
	'BoxSU'     => 'Maengkom\Box\Facades\StandardUserFacade',
	
BoxAU is used for App User for Enterprise box account. BoxSU is used for normal box user to access their asset in their box account.

After this don't forget to run this command below, to copy config file into config folder in Laravel 5 project

	php artisan publish vendor:publish --provider="Maengkom/Box/BoxAPIServiceProvider"
	
for Laravel 4, run this command in terminal

	php artisan publish config:publish maengkom/boxapi


## Installation on Lumen

After install using composer, you need configure some in ```bootstrap/app.php``` file :

	// Uncomment this line below
	$app->withFacades();
	
	// Add these line below to use Facade
	class_alias('Maengkom\Box\Facades\AppUserFacade', 'BoxAU');
	class_alias('Maengkom\Box\Facades\StandardUserFacade', 'BoxSU');
	
	// Register this service provider
	$app->register('Maengkom\Box\BoxAPIServiceProvider');

## Common Installation

Just include the classes you want to use, pick one or both :

	BoxAppUser.php			// Class for App User type
	BoxStandardUser.php		// Class for Standard User type

and these classes are required
	
	BoxContent.php			// Trait content Box Content API Methods
	Helper.php				// Helper class

## Configuration

There are some configuration key to set in boxapi.php in config folder.

Please read the comment and open url box documentation to get the values for those keys.

For App User type, assumed you only need one user for your webserver communicate with your box account. Just set app\_user\_name and package will check if not exist, it will created for you based on name, if exist as app user on your box app, it will use user id to used in application.

## API List

Below are the API method you can used. All methods are following Box documentation.


Name                  | Method                 | Verb   | Url (https)                                      
--------------------- | ---------------------- | ------ | --------------------------------------------------
Get Folder’s Info     | getFolderInfo()        | Get    | api.box.com/2.0/folders/{FOLDER_ID} 
Get Folder's Item     | getFolderItems()       | Get    | api.box.com/2.0/folders/{FOLDER_ID}/items
Create Folder         | createFolder()         | Post   | api.box.com/2.0/folders
Update Folder         | updateFolder()         | Put    | api.box.com/2.0/folders/{FOLDER_ID}
Delete Folder         | deleteFolder()         | Delete | api.box.com/2.0/folders/{FOLDER_ID}
Copy Folder           | copyFolder()           | Post   | api.box.com/2.0/folders/{FOLDER_ID}/copy
Create Shared Link	  | createSharedLink()     | Put    | api.box.com/2.0/folders/{FOLDER_ID}
Folder Collaborations | folderCollaborations() | Get    | api.box.com/2.0/folders/{FOLDER_ID}/collaborations
Get Trashed Items     | getTrashedItems()      | Get    | api.box.com/2.0/folders/trash/items
Get Trashed Folder    | getTrashedFolder()     | Get    | https://api.box.com/2.0/folders/{FOLDER_ID}/trash
Permanently Delete    | permanentDelete()      | Delete | https://api.box.com/2.0/folders/{FOLDER_ID}/trash
Restore Folder        | restoreFolder()        | Get    | https://api.box.com/2.0	

## Example
If you want to get folder information in root, call this methods :

	BoxAU::getFolderInfo('0', true); // Return root folder information using App User in Json format
	BoxSU::getFolderInfo('0', true); // Return root folder information using Standard User in Json format

	