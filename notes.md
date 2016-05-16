Work 3 Notes
============

Reminder: To serve this project locally:

`cd /path/to/wireframer; php -S 0.0.0.0:8080`

Summary of work:

* Iframe used to contain whole page.
* Twitter Bootstrap elements drawn in iframe.
* Template HTML used.

Database
--------

The `dump.sql` file contains the newly improved database. It reflects the original design but now has the following capabilities:

* `Layout` elements store their type as before, but now can store text content for inserting into template elements.
* `Layout` elements are contained within `Project` elements
* `Project` elements can be owned by a `User`. More on that later.

Users
-----

The concept of users allows multiple projects to be worked on by multiple users. The plan is to introduce OpenAuth (Google/Facebook login), which will be added after this iteration has been tested.

Currently, users and projects are selected through the querystring. This will be replaced by a fancy form selector and OpenAuth in the future.

To set your user ID, pass `userID` in the query string. OpenAuth user IDs look something like this: `Facebook-GregBowler1398473252384562` but anything can be used for testing.

To set the project name, pass `projectID` in the query string.

Test example: `http://localhost:8080/wireframer.php?userID=test-user&projectID=123`

