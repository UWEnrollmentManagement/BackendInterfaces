
-----------------------------------------------------------------------
-- element
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [element];

CREATE TABLE [element]
(
    [id] INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    [retired] INTEGER DEFAULT 0 NOT NULL,
    [type] VARCHAR(31) NOT NULL,
    [label] VARCHAR(8191) NOT NULL,
    [initial_value] VARCHAR(127),
    [help_text] VARCHAR(4095),
    [placeholder_text] VARCHAR(127),
    [required] INTEGER DEFAULT 1 NOT NULL,
    [parent_id] INTEGER,
    UNIQUE ([id]),
    FOREIGN KEY ([parent_id]) REFERENCES [element] ([id])
        ON DELETE SET NULL
);

-----------------------------------------------------------------------
-- form
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [form];

CREATE TABLE [form]
(
    [id] INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    [name] VARCHAR(127) NOT NULL,
    [slug] VARCHAR(127) NOT NULL,
    [success_message] VARCHAR(1683) DEFAULT '',
    [retired] INTEGER DEFAULT 0 NOT NULL,
    [root_element_id] INTEGER,
    UNIQUE ([id]),
    FOREIGN KEY ([root_element_id]) REFERENCES [element] ([id])
        ON DELETE SET NULL
);

-----------------------------------------------------------------------
-- visitor
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [visitor];

CREATE TABLE [visitor]
(
    [id] INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    [uw_student_number] MEDIUMBLOB,
    [uw_net_id] MEDIUMBLOB NOT NULL,
    [first_name] MEDIUMBLOB,
    [middle_name] MEDIUMBLOB,
    [last_name] MEDIUMBLOB,
    UNIQUE ([id])
);
