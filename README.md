1) Run db.sql to install database;
2) There is only one admin user at the beginning: test|test;
3) User can edit only personal information but can create new users;
4) New user's login and password are set at creation (thus, intial credentials are given to newly crated usr as is) but later can be changed only by this exactly user;
5) Newly created user could or could not be added to the group at creation but also could be invited or removed from the group later;
6) Any user cannot invite or remove himself to/from the group;
7) Passwords are stored at the simpliest way - md5 encryption;
8) To be able to edit feeds and users, any user must log in first. He/she must be in the group at that moment;
9) Any user that is in the group can add/edit/preview/delete any feeds but cannot handle comments.  
10) Possibility to post text, image, video is represented in one wysiwyg editor to make it a bit more user-friendly.
Feed content field has longtext format because of this, though, and that's here for demonstration purpose, not optimized, as image content is stored in base64 in line with plain text.
Also could be an option to store miscellaneous data in one feed field.