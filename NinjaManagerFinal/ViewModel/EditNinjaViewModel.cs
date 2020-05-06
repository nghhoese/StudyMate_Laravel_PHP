using GalaSoft.MvvmLight.Command;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Input;

namespace NinjaManagerFinal.ViewModel
{
    public class EditNinjaViewModel
    {
        private NinjaListViewModel _ninjaListViewModel;
        public ICommand EditNinja { get; set; }
        public NinjaListViewModel NinjaListVM { get { return _ninjaListViewModel; } }

        public EditNinjaViewModel(NinjaListViewModel ninjaListViewModel)
        {

            EditNinja = new RelayCommand(Edit);
            _ninjaListViewModel = ninjaListViewModel;

        }
        private void Edit()
        {

            using (var context = new NinjaManagerDBEntities1())
            {

                context.Entry(_ninjaListViewModel.SelectedNinja.ToModel()).State = System.Data.Entity.EntityState.Modified;

                context.SaveChanges();
            }
            _ninjaListViewModel.CloseEdit();
        }
    }
}
