using GalaSoft.MvvmLight.Command;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Input;

namespace NinjaManagerFinal.ViewModel
{
    public class AddItemViewModel
    {


        private ItemViewModel _item;
        public ICommand AddItem { get; set; }
        private String[] _categories;
        private NinjaShopListViewModel _shopViewModel;
        public ItemViewModel Item
        {
            get
            {
                return _item;
            }
        }
        public String[] Categories
        {
            get
            {
                return _categories;
            }
        }
        public AddItemViewModel(NinjaShopListViewModel shopViewModel)
        {
            _shopViewModel = shopViewModel;
            _categories = new string[6];
            _categories[0] = "head";
            _categories[1] = "shoulders";
            _categories[2] = "chest";
            _categories[3] = "belt";
            _categories[4] = "legs";
            _categories[5] = "boots";

            _item = new ItemViewModel();

            AddItem = new RelayCommand(Add);
        }
        private void Add()
        {
            if (_item.category_name != null && _item.Gold > 0)
            {
               

                using (var context = new NinjaManagerDBEntities1())
                {


                    context.Item.Add(_item.ToModel());
                    context.SaveChanges();
                }
                _shopViewModel.ShopItems.Add(_item);
                _shopViewModel.CloseAdd();
            }


        }

    }
}
