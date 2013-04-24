# WP-CLI JSON info

This is a command for WP-CLi that makes it possible to encode your Wordpress install information (such as plugin and core details) in JSON format through the console of [wp-cli](https://github.com/wp-cli/wp-cli). The goal of this project is to provide a dataset for applications to parse this information that may not be running on PHP.



## Reasons to start this project

* There were no other alternatives for retreiving data like this (in JSON format) about your plugins and core version.
* Not all application that want to parse your Wordpress install information run on PHP. I have built my own application to have a nice overview of my Wordpress installs on my servers, which runs on Ruby, that can use this command to parse the information.

With this plugin running in my installs, beside WP-CLI, it made it possible for me to directly parse the command line result into JSON in Ruby.



### Requirements

* `wp-cli` download from [GitHub](http://github.com/wp-cli/wp-cli/) or use the pear package



### Commands

This project adds the `json` command to `wp-cli` with the following subcommands:
  
* `wp json core`: returns the Wordpress core functionality versions encoded in JSON format.

* `wp json plugin`: returns the Wordpress plugin information of the plugins that reside in your plugins folder in JSON format.
    
* `wp json`: Default test and prints the help overview.



### How to use

1. install `wp-cli` (pear or download)
2. put the `wp-cli-json` folder in `wp-content/plugins`
3. activate `wp-cli-json` plugin through "wp plugin activate wp-cli-json"
4. go the terminal and go to your wordpress folder
5. type `wp` (and see the wp-cli commands if installed correctly)
6. type `wp json` to test the `wp-cli-json` extension
7. start using the commands as explained in "Commands"

### Versions

#### 0.1

* Initial project start
* Added core and plugin commands
* wrote first version of readme.txt
