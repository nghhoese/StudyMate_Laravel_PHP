using GalaSoft.MvvmLight.Command;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Input;

namespace NinjaManagerFinal.ViewModel
{

    public class EditItemViewModel
    {
        private NinjaShopListViewModel _shopViewModel;






        public ICommand EditItem { get; set; }
        private String[] _categories;
        public NinjaShopListViewModel Shop
        {
            get
            {
                return _shopViewModel;
            }
        }
        public String[] Categories
        {
            get
            {
                return _categories;
            }
        }
        public EditItemViewModel(NinjaShopListViewModel shopViewModel)
        {
            _shopViewModel = shopViewModel;
            _categories = new string[6];
            _categories[0] = "head";
            _categories[1] = "shoulders";
            _categories[2] = "chest";
            _categories[3] = "belt";
            _categories[4] = "legs";
            _categories[5] = "boots";



            EditItem = new RelayCommand(Edit);
        }
        private void Edit()
        {
            if (_shopViewModel.SelectedItem != null)
            {
                var temp = new ItemViewModel(_shopViewModel.SelectedItem.ToModel());
                using (var context = new NinjaManagerDBEntities1())
                {

                    context.Entry(_shopViewModel.SelectedItem.ToModel()).State = System.Data.Entity.EntityState.Modified;

                    context.SaveChanges();
                }
                _shopViewModel.ShopItems.Remove(_shopViewModel.SelectedItem);
                _shopViewModel.ShopItems.Add(temp);
                _shopViewModel.CloseEdit();

            }


        }
    }
}
