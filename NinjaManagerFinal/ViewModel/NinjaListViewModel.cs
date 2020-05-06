using GalaSoft.MvvmLight.CommandWpf;
using NinjaManagerFinal.View;
using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Input;

namespace NinjaManagerFinal.ViewModel
{
    public class NinjaListViewModel : GalaSoft.MvvmLight.ViewModelBase
    {
        public ObservableCollection<NinjaViewModel> Ninjas { get; set; }

        public ICommand ShowShop { get; set; }
        public ICommand ShowInventory { get; set; }
        public ICommand ShowEditWindow { get; set; }
        public ICommand AddNinja { get; set; }
        public ICommand DeleteNinja { get; set; }

        private View.AddNinja _addNinjaWindow;
        private View.EditNinja _editNinjaWIndow;
        private NinjaViewModel _selectedNinja;


        public NinjaViewModel SelectedNinja
        {
            get { return _selectedNinja; }
            set
            {
                _selectedNinja = value;

                base.RaisePropertyChanged();



            }
        }

        public NinjaListViewModel()
        {

            ShowShop = new RelayCommand(Shop,NotNull);
            ShowInventory = new RelayCommand(Inventory, NotNull);
            AddNinja = new RelayCommand(Add);
            DeleteNinja = new RelayCommand(Remove, NotNull);
            ShowEditWindow = new RelayCommand(Edit, NotNull);


            using (var context = new NinjaManagerDBEntities1())
            {

                var ninjas = context.Ninja.Include("Item").ToList();

                context.SaveChanges();
                Ninjas = new ObservableCollection<NinjaViewModel>(ninjas.Select(n => new NinjaViewModel(n)));


            }
        }
        private void Add()
        {

            _addNinjaWindow = new View.AddNinja();
            _addNinjaWindow.Show();

        }
        public void CloseAdd()
        {
            _addNinjaWindow.Close();
        }
        private void Remove()
        {


            
            
                using (var context = new NinjaManagerDBEntities1())
                {
                    context.Ninja.Attach(_selectedNinja.ToModel());
                    context.Ninja.Remove(_selectedNinja.ToModel());
                    context.SaveChanges();
                }
                this.Ninjas.Remove(_selectedNinja);
            
        }
        private void Shop()
        {
            
            
                var window = new View.Shop();
                window.Show();
            
        }
        private bool NotNull()
        {
            if (_selectedNinja != null)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        private void Inventory()
        {
            
            

                var window1 = new View.Inventory();
                window1.Show();
            
        }
        private void Edit()
        {
            
                _editNinjaWIndow = new View.EditNinja();
                _editNinjaWIndow.Show();
            
        }
        public void CloseEdit()
        {
            _editNinjaWIndow.Close();
        }

    }
}
