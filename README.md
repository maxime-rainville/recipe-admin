# SilverStripe recipe-admin
`recipe-admin` is a SilverStripe recipe designed for projects that only need to use the "administration" part of SilverStripe to manage DataObjects:
* Strips out CMS functionality,
* Set the administration area as the default route,
* Add a generic login screen so you don't have style your own,
* Showcase generic DataObject that you can be copied and adapted for your purpose,
* Showcase how to set up default groups,
* Showcase a generic report.

## Installation

```bash
# If starting a brand new project
composer create-project silverstripe/recipe-admin your-project-folder

# If you already have a composer file
composer require silverstripe/recipe-admin
```