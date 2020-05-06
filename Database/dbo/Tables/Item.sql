CREATE TABLE [dbo].[Item] (
    [iditem]        INT          IDENTITY (1, 1) NOT NULL,
    [name]          VARCHAR (45) NOT NULL,
    [price]         INT          CONSTRAINT [DF_Item_price] DEFAULT ((0)) NOT NULL,
    [category_name] VARCHAR (45) NOT NULL,
    [strenght]      INT          CONSTRAINT [DF__item__strenght__4E88ABD4] DEFAULT ((0)) NULL,
    [intelligence]  INT          CONSTRAINT [DF__item__intelligen__4F7CD00D] DEFAULT ((0)) NULL,
    [agility]       INT          CONSTRAINT [DF__item__agility__5070F446] DEFAULT ((0)) NULL,
    [sold]          VARCHAR (3)  CONSTRAINT [DF_Item_sold] DEFAULT ('no') NULL,
    PRIMARY KEY CLUSTERED ([iditem] ASC)
);


GO
CREATE NONCLUSTERED INDEX [fk_item_category1_idx]
    ON [dbo].[Item]([category_name] ASC);

