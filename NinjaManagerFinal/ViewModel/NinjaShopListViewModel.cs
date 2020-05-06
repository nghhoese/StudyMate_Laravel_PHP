
using GalaSoft.MvvmLight.CommandWpf;
using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Input;

namespace NinjaManagerFinal.ViewModel
{
    public class NinjaShopListViewModel : GalaSoft.MvvmLight.ViewModelBase
    {
        public ObservableCollection<ItemViewModel> ShopItems { get; set; }
        private NinjaViewModel _selectedNinja;
        private ItemViewModel _selectedItem;
        public ICommand ShowShoulders { get; set; }
        public ICommand ShowHead { get; set; }
        public ICommand ShowChest { get; set; }
        public ICommand ShowBoots { get; set; }
        public ICommand ShowBelt { get; set; }
        public ICommand ShowLegs { get; set; }
        public ICommand BuyItem { get; set; }
        public ICommand AddItem { get; set; }
        public ICommand EditItem { get; set; }

        public ICommand DeleteItem { get; set; }

        private View.AddItemWindow _addItemWindow;
        private View.EditItemWindow _editItemWindow;
        public ItemViewModel SelectedItem
        {
            get { return _selectedItem; }
            set
            {
                _selectedItem = value;

                base.RaisePropertyChanged();



            }
        }
        public NinjaViewModel SelectedNinja
        {
            get { return _selectedNinja; }

        }

        public NinjaShopListViewModel(NinjaViewModel n)
        {
            this._selectedNinja = n;
            ShowShoulders = new RelayCommand(ShowItemsShoulders);
            ShowChest = new RelayCommand(ShowItemsChest);
            ShowBelt = new RelayCommand(ShowItemsBelt);
            ShowLegs = new RelayCommand(ShowItemsLegs);
            ShowBoots = new RelayCommand(ShowItemsBoots);
            ShowHead = new RelayCommand(ShowItemsHead);
            ShopItems = new ObservableCollection<ItemViewModel>();
            BuyItem = new RelayCommand(Buy,CanBuy);
            AddItem = new RelayCommand(Add);
            EditItem = new RelayCommand(Edit,CanEdit);
            DeleteItem = new RelayCommand(Delete,CanDelete);

        }
        private void ShowItemsShoulders()
        {
            ShowItems("shoulders");

        }
        private void ShowItemsHead()
        {
            ShowItems("head");

        }
        private void ShowItemsBelt()
        {
            ShowItems("belt");

        }
        private void ShowItemsChest()
        {
            ShowItems("chest");

        }
        private void ShowItemsBoots()
        {
            ShowItems("boots");

        }
        private void ShowItemsLegs()
        {
            ShowItems("legs");

        }


        private void ShowItems(String category)
        {
            ShopItems.Clear();
            using (var context = new NinjaManagerDBEntities1())
            {

                var shopitems = context.Item.Include("Ninja").Where(i => i.category_name == category ).ToList();
                context.SaveChanges();
                foreach (Item i in shopitems)
                {
                    ShopItems.Add(new ItemViewModel(i));
                }

                


            }
        }
        private bool CanEdit()
        {
            if (_selectedItem != null)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        private void Buy()
        {
         
           
                using (var context = new NinjaManagerDBEntities1())
                {


                    var att = context.Ninja.Attach(_selectedNinja.ToModel());
                    context.Item.Attach(_selectedItem.ToModel());
                    
                   _selectedNinja.ToModel().Item.Add(_selectedItem.ToModel());
                    att.gold = _selectedNinja.Gold - _selectedItem.Gold;
                    context.SaveChanges();
                }

            
                _selectedNinja.Items.Add(_selectedItem);
                _selectedNinja.Gold = _selectedNinja.Gold;
                ShopItems.Remove(_selectedItem);
            }
        
        private void Add()
        {
            _addItemWindow = new View.AddItemWindow();
            _addItemWindow.Show();
        }
        private void Edit()
        {
           
            
                _editItemWindow = new View.EditItemWindow();
                _editItemWindow.Show();
            
        }
        public void CloseEdit()
        {
            _editItemWindow.Close();
        }
        public void CloseAdd()
        {
            _addItemWindow.Close();
        }
        private void Delete()
        {
            if (CanDelete())
            {
                var item = _selectedItem;

                using (var context = new NinjaManagerDBEntities1())
                {
                   
                    context.Item.Attach(_selectedItem.ToModel());

                    context.Item.Remove(_selectedItem.ToModel());
                    context.SaveChanges();

                }

              ShopItems.Remove(_selectedItem);


            }
        }
        private bool CanDelete()
        {
            if (_selectedItem != null)
            {
                if (_selectedItem.ToModel().Ninja.Count > 0)
                {
                    return false;
                }
                else
                {
                    return true;
                }
            }
            else
            {
                return false;
            }
        }
        private bool CanBuy()
        {
            if (_selectedItem != null)
            {
                if (_selectedNinja.Gold >= _selectedItem.Gold)
                {
                    foreach (ItemViewModel i in _selectedNinja.Items)
                    {
                        if (i.category_name.Equals(_selectedItem.category_name))
                        {
                            return false;
                        }

                    }
                    return true;
                }
                return false;
            }
            else
            {
                return false;
            }
        }
    }
}
