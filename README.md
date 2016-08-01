[![Build Status](https://travis-ci.org/GrandadEvans/domanamon.svg?branch=master)](https://travis-ci.org/GrandadEvans/domanamon)

# Domanamon
## Domain management tool

### The plan
The plan is for this to be a domain monitor and management tool.
I want it to:

* provide an up to date screenshot
* domain expiry etc
* status
* price paid and estimates value
* host and server
* Github status
* CI/Tests status
* many other features that I have seen on a few other tools

It will:

* use Test Driven Development (TDD)
* use Open Object Programming
* be written within the SOLID guidelines
* use the PSRs
* initially be open source but may become Software As A Service (SAAS)

## Setup
### PHP Versions
Because I am insisting on using PHP version 7 there are a few tweaks
that need to be made. I will be making a vagrant file available or
possibly a Laravel Homestead.yaml file which will standardise the
versioning.

The problem is that the host offers multiple versions of php. This
even extends to directory specific version.

It may be required that you create a symlink from php70 to your normal
version 7 of php eg ln /usr/bin/php ./php70 (assuming your normal
version of php is 7. For this reason I have added php70 to the
.gitignore file.

I am open to suggestions on this one though as I do not believe this
is the best way to proceed.

## Todo
* @todo: Create VM file such as Homestead.yaml or Vagrantfile

### Actions Completed
* Baseline for the phpunit test suite created
* YouTrack issue tracker set up as subdomain locally until remote set up
