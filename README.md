Stan's plan:

Github, make a place to put things
Set up the db with tables
Make php pages for the admin side
learn the json stuffs
ravamp the app

Get it done in a month.

We can do this.



Pages we need for the provider side:
Login
First time - Make your classes, clubs, sports, etc.
View of all announcements
Make new announcements/edit announcements
Settings (make same as first time)

Magic admin powers:
Above +
-View all users
-Make/Change/Delete users
-Edit all classes, clubs, sports, etc.
-Access to all announcements

My job:
make a settings screen
remember: value to fill in inputs

What the settings should do:
have:
-username
-password
-email
-names, first and last
-subtypes

I think there need to be to forms of this:
The first one is for when the user is first being created (so this is for the admin) (uses INSERT, for insert creates a new row)
The second is for what the user sees, so they actually UPDATE their stats

Lets make the admin one first.

How about there be a checkbox at top that says "new" or "edit"
It'll appear depending on if the person is an admin or user
that way, it differenciates between making a new user and editing an existing one

No there should probably just be two different pages. The new user page only exists for the admin. The actual settings page will only be an edit thing.

Perhaps for the sake of simplicity right now, we only make the adding user part first.
This needs to grab all the variables from the form and insert them into the users table.

Add a way to prevent duplicates.

Now the fun stuff, make a way for the users to edit themselves.
This requires getting the user data from the database and echoing them back into the text inputs as the values
It also needs a way to read the user_id, which will be determined by the session.

Figure out how the mysql_fetch_array works. It appears to take the row data in the form of an array.
I'll need to get that data and store it inside some sort of array.
Look at db.class.php for more info.

BIGGEST THING TO DO: Figure out what kind of data is returned by the mysql_fetch_array and how to manipulate it into a php array.

Session variables:
user_id
permissions

BIG QUESTION:
Do we set the empty subtypes when creating the user, or do we create the subtypes at the settings page?

NOTE TO MENTION:
Removed the periods from the users table.