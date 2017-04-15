# tds_highlight_file

Ever had the need to present your lines of code in a teasing fashion? Have a look at this add-on.

## File Contents Highlighted

For different purposes concrete5 brings a JavaScript based editor for different languages called ace editor. 
This powerful editor is very useful to comfortably display of your own code examples, too. 
Some of the editor's features: syntax highlighting for over 110 languages, automatic indent and outdent...

Installation of the Highlight File add-on works as usual. The installed block shows in the composer Blocks/Basics section.

Add a Highlight File block at any page position.

The add/edit dialogue box lets you select a file from the files starting at the web server's document root folder.

To add files not involved in concrete5 I have added a folder called external at the file server's root folder.

The selected file path is shown in the grey box below the file selection dialogue. 
On selection of a file the Highlight File type is detected, if possible. 
The implementation supports all languages of the ace editor. 
In case of automatic detection fails the file type txt is taken as default.

After saving the selection the file contents are shown highlighted in your page.
