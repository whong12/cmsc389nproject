"# cmsc389nproject" 
CMSC389N Project Tasks:

Create Basic chat with template (by 29th)
	-Daniel: Login page (go thru database). provide create table command so we can easily create the same table
	-Wilson: Chatbox (store messages in database with metadata, provide create table command)
	-Chris: User settings page (delete profile, update settngs, etc)
	
'Messages' database:
	-messageid (sequential id) (int)
	-content (string)
	-timestamp (datetime)
	-sender (string) (foreign key to usernamme database)
	-target (default 'all', can be a uername if we decide to support private messages)
	
Notification when new message is sent
	Audio and visual cue (like how facebook has the "New Message From X" appears on the Title

Make Profile Pictures for each user
	Add in a field in SQL database
	Display to the left of username in chat

Add in Passwords
	Add in field in SQL database
	Add field to form
	Use javascript to enforce particular settings for passwords (at least 1 capital letter, at least 1 digit, at least 1 special character, at least 6 characters long)

Add way for users to report and ban other users
	Add field to SQL database that designates whether a user is banned or not
	There should be a button that links to a form that users can fill out
	Form would include things like
		Username of person to report
		Checkboxes for options of why they are reporting the user
		Comment box
	The form would send an email to an admin where they can review the form
	Admin can edit the specific field that designates whether the user is banned or not
	If user tries to login, but they are banned, then do not let them login and tell them to contact the administrator

Support for adding images/video
	Either use image link or upload a file with the correct extension (.jpg, .jpeg, .png, .gif)
		Uploaded file stored in a folder and linked to with img tag
	Video: embed code

Metadata for each message
	Timestamps
	Sequential ID
	Sender username

Font decorations
	Bold, underline, italic
	Font color?

Private messages
	Message user directly (inbox feature or separate chat room)
