using GalaSoft.MvvmLight;
using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace NinjaManagerFinal.ViewModel
{
    public class NinjaViewModel : ViewModelBase
    {
        private Ninja n;
        public ObservableCollection<ItemViewModel> Items { get; set; }

        public NinjaViewModel()
        {
            n = new Ninja();
            n.gold = 3000;
            Items = new ObservableCollection<ItemViewModel>();
        }

        public NinjaViewModel(Ninja n)
        {
            this.n = n;
            var list = n.Item.Select(i => new ItemViewModel(i));
            Items = new ObservableCollection<ItemViewModel>(list);

        }
        public int Id
        {
            get { return n.idninja; }
            set { n.idninja = value; RaisePropertyChanged("Id"); }
        }
        public int Gold
        {
            get { return (int)n.gold; }
            set { n.gold = value; RaisePropertyChanged("Gold"); }
        }
        public string Name
        {
            get { return n.name; }
            set { n.name = value; RaisePropertyChanged("Name"); }
        }



        internal Ninja ToModel()
        {
            return n;
        }
    }
}
