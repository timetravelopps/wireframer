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

