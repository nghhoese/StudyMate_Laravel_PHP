using GalaSoft.MvvmLight.Command;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Input;

namespace NinjaManagerFinal.ViewModel
{
    public class AddNinjaViewModel
    {
        private NinjaListViewModel _ninjaListViewModel;

        private NinjaViewModel _ninja;
        public ICommand AddNinja { get; set; }
        public NinjaViewModel Ninja
        {
            get
            {
                return _ninja;
            }
        }
        public AddNinjaViewModel(NinjaListViewModel ninjaListViewModel)
        {
            _ninja = new NinjaViewModel();
            _ninjaListViewModel = ninjaListViewModel;
            AddNinja = new RelayCommand(Add);
        }
        private void Add()
        {

            using (var context = new NinjaManagerDBEntities1())
            {


                context.Ninja.Add(_ninja.ToModel());
                context.SaveChanges();
            }

            _ninjaListViewModel.Ninjas.Add(_ninja);
            _ninjaListViewModel.CloseAdd();
        }
    }
}
