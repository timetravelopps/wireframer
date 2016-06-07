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

Test example: `http://localhost:8080/wireframe_page.php?userID=test-user&projectID=123`

> Once the user and project is set (for testing, this is done in the query string), it is stored in the session. To use it, `session.php` must be required in subsequent scripts.

Templates
---------

Templates are HTML files that have the filename of the element they represent. They are loaded into the bootrap-ready page, and their content is injected from the database.

Content can be injected by placing two braces around the placeholder content. For example, to inject the contents of a header: `<h1>{Content goes here}</h1>`, and the whole `content` field from the database is added in-place. For multiple pieces of content per template, the database field can be split up using braces, with matching content names. For example, to inject a link's URL and text at once: `<a href="{(url)http://blah.blah.blah}">{(text)Link text here}</a>` and the database `content` field can be as such: `{url}http://twitter.com/g105b{text}Greg's twitter page.`.

The syntax of content placeholders can be easily tweaked to allow for different approaches, but this has been used so far to promote simplicity and rapid prototyping.

For proof of concept, we have two really simple templates: `heading` and `carousel`.
