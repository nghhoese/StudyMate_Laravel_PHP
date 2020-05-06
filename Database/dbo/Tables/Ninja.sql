CREATE TABLE [dbo].[Ninja] (
    [idninja] INT          IDENTITY (1, 1) NOT NULL,
    [gold]    INT          DEFAULT ('3000') NULL,
    [name]    VARCHAR (50) NULL,
    PRIMARY KEY CLUSTERED ([idninja] ASC)
);

