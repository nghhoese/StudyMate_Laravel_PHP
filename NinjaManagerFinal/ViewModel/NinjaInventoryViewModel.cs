using GalaSoft.MvvmLight.Command;
using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Input;

namespace NinjaManagerFinal.ViewModel
{
    public class NinjaInventoryViewModel : GalaSoft.MvvmLight.ViewModelBase
    {

        public ObservableCollection<ItemViewModel> Items { get; set; }
        public ICommand SellItem { get; set; }
        public ICommand Reset { get; set; }

        private NinjaViewModel _selectedNinja;
        private ItemViewModel _selectedItem;
        private int _gearValue;
        private int _totalAgility;
        private int _totalStrenght;
        private int _totalIntelligence;
        public ItemViewModel Head
        {
            get
            {
                return _selectedNinja.Items.Where(i => i.category_name.ToLower() == "head").FirstOrDefault();
            }
            
   
        }
        public ItemViewModel Chest
        {
            get
            {
                return _selectedNinja.Items.Where(i => i.category_name.ToLower() == "chest").FirstOrDefault();
            }


        }
        public ItemViewModel Shoulders
        {
            get
            {
                return _selectedNinja.Items.Where(i => i.category_name.ToLower() == "shoulders").FirstOrDefault();
            }


        }
        public ItemViewModel Belt
        {
            get
            {
                return _selectedNinja.Items.Where(i => i.category_name.ToLower() == "belt").FirstOrDefault();
            }


        }
        public ItemViewModel Legs
        {
            get
            {
                return _selectedNinja.Items.Where(i => i.category_name.ToLower() == "legs").FirstOrDefault();
            }


        }
        public ItemViewModel Feet
        {
            get
            {
                return _selectedNinja.Items.Where(i => i.category_name.ToLower() == "boots").FirstOrDefault();
            }


        }


        public int GearValue
        {
            get
            {
                return _gearValue;
            }
            set
            {
                _gearValue = value;
                RaisePropertyChanged("GearValue");
            }
        }
        public int TotalAgility
        {
            get
            {
                return _totalAgility;
            }
            set
            {
                _totalAgility = value;
                RaisePropertyChanged("TotalAgility");
            }
        }
        public int TotalStrenght
        {
            get
            {
                return _totalStrenght;
            }
            set
            {
                _totalStrenght = value;
                RaisePropertyChanged("TotalStrenght");
            }
        }
        public int TotalIntelligence
        {
            get
            {
                return _totalIntelligence;

            }
            set
            {
                _totalIntelligence = value;
                RaisePropertyChanged("TotalIntelligence");
            }
        }
 
        public NinjaInventoryViewModel(NinjaViewModel n)
        {

            SellItem = new RelayCommand<String>(Sell);
            Reset = new RelayCommand(StartOver);
            this._selectedNinja = n;
            Items = _selectedNinja.Items;
            CalculateTotals();







        }

        private void CalculateTotals()
        {
            TotalStrenght = 0;
            TotalAgility = 0;
            TotalIntelligence = 0;
            GearValue = 0;

            foreach (ItemViewModel i in Items)
            {
                TotalStrenght = TotalStrenght + i.Strenght;
                TotalAgility = TotalAgility + i.Agility;
                TotalIntelligence = TotalIntelligence + i.Intelligence;
                GearValue = GearValue + i.Gold;
            }

        }

        private void Sell(String category)
        {
            _selectedItem = _selectedNinja.Items.Where(i => i.category_name.ToLower() == category).FirstOrDefault();
            if (_selectedItem != null)
            {
                using (var context = new NinjaManagerDBEntities1())
                {

                    

                    var att = context.Ninja.Attach(_selectedNinja.ToModel());
                   _selectedNinja.ToModel().Item.Remove(_selectedItem.ToModel());
                    att.gold = _selectedNinja.Gold + _selectedItem.Gold;
                    context.SaveChanges();
                }

                _selectedNinja.Items.Remove(_selectedItem);
                _selectedNinja.Gold = _selectedNinja.Gold;
                base.RaisePropertyChanged("Shoulders");
                base.RaisePropertyChanged("Head");
                base.RaisePropertyChanged("Feet");
                base.RaisePropertyChanged("Belt");
                base.RaisePropertyChanged("Legs");
                base.RaisePropertyChanged("Chest");
                CalculateTotals();
            }
        }
        private void StartOver()
        {
            foreach (ItemViewModel i in _selectedNinja.Items)
            {
                using (var context = new NinjaManagerDBEntities1())
                {


                    var att = context.Ninja.Attach(_selectedNinja.ToModel());
                    _selectedNinja.ToModel().Item.Remove(i.ToModel());
                    att.gold = _selectedNinja.Gold + i.Gold;
                    context.SaveChanges();
                }


                _selectedNinja.Gold = _selectedNinja.Gold;
            }
            _selectedNinja.Items.Clear();
            Items.Clear();
            CalculateTotals();
        }


    }
}
