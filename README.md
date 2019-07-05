# SilverStripe recipe-admin
`recipe-admin` is a SilverStripe recipe designed for "portal" projects that only need to use the "administration" part of SilverStripe to manage DataObjects:

## What does the recipe do?
* Strips out CMS functionality,
* Set the administration area as the default route,
* Add a generic login screen so you don't have style your own,
* Showcase generic DataObject that you can be copied and adapted for your purpose,
* Showcase how to set up default groups,
* Showcase a generic report.

[View a short video of a recipe-admin project](https://youtu.be/J-H9SbvNQFo) 


## Getting started

Add recipe-admin to your composer file.

```bash
# If starting a brand new project
composer create-project maxime-rainville/recipe-admin your-project-folder

# If you already have a composer file
composer require maxime-rainville/recipe-admin
```

Rename `.env-sample` to `.env` and adjust the settings according to your environment.

From here, just follow the normal set up steps for a SilverStripe project. 

## What to do next?

The recipe comes with some simple examples to help you get started quickly. But you will need to tweak the example code to your use case.

### Set up your DataObjects

Two basic DataObjects are included in the basic recipe: Dog and Breed. Both of them come with sample code illustrating how to:
* define basic relations
* set basic validation rules
* define basic permissions.

Copy or rename these DataObject to suit your use case.

### Define an ModelAdmin controller

Dog and Breed can be managed via the "DogAdmin" `ModelAdmin`. Rename `DogAdmin` and adjust it to reference your own DataObjects.

### Set the default area in the Model

Recipe-admin is configured to have a default administration area. This will be the first screen your users will see after login into your portal.

By default this points to `DogAdmin`. Update `app/_config/routes.yml` to point to your own `ModelAdmin`

```diff
SilverStripe\Admin\AdminRootController:
  url_base: 'a'
-  default_panel: DogAdmin
+  default_panel: YourCustomAdmin
```

### Define some default data

`recipe-admin` comes with some default records. This pre-populates your project with some data with your first `dev/build`. When setting up a new environment, this allows you to quickly get started without having to load a database snapshot.

Adjust `app/_config/default-records.yml` to reflect your own DataObjects.

### Define some default groups

`recipe-admin` ships with a simple `DataExtension` showing you how do define default groups. Adjust the groups and permission define `app/_config/default-records.yml` to reflect your own DataObjects.

### Create some reports for your users

`BreedReport` shows you how you can create a custom report to allow your user to get refine view of their data.

If your users don't need this data, simply delete `BreedReport` and the "Report" panel will be hidden. 