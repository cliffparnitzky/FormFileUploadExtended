Contao Extension: FormFileUploadExtended
========================================

Provides extended functions for form file upload fields, e.g.

- prohibits editing of definied form file upload fields in the frontend (for example if a file should upload is mandatory, but should only be done once).
- resolve uploaded file data in a result page (using insert tags)


Installation
------------

The extension is not published in contao extension repository.
Install it manually.


Tracker
-------

https://github.com/cliffparnitzky/FormFileUploadExtended/issues


Compatibility
-------------

- min. version: Contao 2.9.5
- max. version: Contao 2.11.x


Dependency
----------

- There are no dependencies to other extensions, that have to be installed.


Inserttags
----------

    {{upload::field_name}} ... returns the path to the uploaded file
    {{upload::field_name::name}} ... returns the name of the uploaded file
    {{upload::field_name::type}} ... returns the filetype of the uploaded file
    {{upload::field_name::size}} ... returns the size of the uploaded file in bytes
    {{upload::field_name::size::MB}} ... returns the size of the uploaded file in MB (instead using MB, KB or GB is also possible, the size will be rounded by default to 2 decimal places)
    {{upload::field_name::size::KB::4}} ... returns the size of the uploaded file in kilobytes rounded to 4 decimal places