using GalaSoft.MvvmLight;
using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace NinjaManagerFinal.ViewModel
{
    public class ItemViewModel : ViewModelBase
    {
        private Item i;

        public ItemViewModel()
        {
            i = new Item();

        }

        public ItemViewModel(Item i)
        {
            this.i = i;

        }
        public int Id
        {
            get { return i.iditem; }
            set { i.iditem = value; RaisePropertyChanged("Id"); }
        }
        public int Gold
        {
            get { return (int)i.price; }
            set { i.price = value; RaisePropertyChanged("Gold"); }
        }
        public int Strenght
        {
            get
            {
                if (i.strenght != null)
                {
                    return (int)i.strenght;
                }
                else
                {
                    return 0;
                }
            }
            set { i.strenght = value; RaisePropertyChanged("Strenght"); }
        }
        public int Agility
        {
            get
            {
                if (i.agility != null)
                {
                    return (int)i.agility;
                }
                else
                {
                    return 0;
                }
            }
            set { i.agility = value; RaisePropertyChanged("Agility"); }
        }
        public int Intelligence
        {
            get
            {
                if (i.intelligence != null)
                {
                    return (int)i.intelligence;
                }
                else
                {
                    return 0;
                }
            }
            set { i.intelligence = value; RaisePropertyChanged("Intelligence"); }
        }
        public string Name
        {
            get { return i.name; }
            set { i.name = value; }

        }
  
        public string category_name
        {
            get { return i.category_name; }
            set { i.category_name = value; }

        }
        public ObservableCollection<NinjaViewModel> Ninjas { get; set; }

        internal Item ToModel()
        {
            return i;
        }
    }
}
