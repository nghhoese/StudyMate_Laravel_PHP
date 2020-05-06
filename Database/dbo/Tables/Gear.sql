CREATE TABLE [dbo].[Gear] (
    [ninja_idninja] INT NOT NULL,
    [item_iditem]   INT NOT NULL,
    PRIMARY KEY CLUSTERED ([ninja_idninja] ASC, [item_iditem] ASC),
    CONSTRAINT [fk_ninja_has_item_item1] FOREIGN KEY ([item_iditem]) REFERENCES [dbo].[Item] ([iditem]),
    CONSTRAINT [fk_ninja_has_item_ninja1] FOREIGN KEY ([ninja_idninja]) REFERENCES [dbo].[Ninja] ([idninja])
);

