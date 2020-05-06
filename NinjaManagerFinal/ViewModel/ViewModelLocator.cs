/*
  In App.xaml:
  <Application.Resources>
      <vm:ViewModelLocator xmlns:vm="clr-namespace:NinjaManagerFinal"
                           x:Key="Locator" />
  </Application.Resources>
  
  In the View:
  DataContext="{Binding Source={StaticResource Locator}, Path=ViewModelName}"

  You can also use Blend to do all this with the tool's support.
  See http://www.galasoft.ch/mvvm
*/

using CommonServiceLocator;
using GalaSoft.MvvmLight;
using GalaSoft.MvvmLight.Ioc;


namespace NinjaManagerFinal.ViewModel
{
    /// <summary>
    /// This class contains static references to all the view models in the
    /// application and provides an entry point for the bindings.
    /// </summary>
    public class ViewModelLocator
    {
        private NinjaShopListViewModel _shop;
        /// <summary>
        /// Initializes a new instance of the ViewModelLocator class.
        /// </summary>
        public ViewModelLocator()
        {

            CommonServiceLocator.ServiceLocator.SetLocatorProvider(() => SimpleIoc.Default);

            ////if (ViewModelBase.IsInDesignModeStatic)
            ////{
            ////    // Create design time view services and models
            ////    SimpleIoc.Default.Register<IDataService, DesignDataService>();
            ////}
            ////else
            ////{
            ////    // Create run time view services and models
            ////    SimpleIoc.Default.Register<IDataService, DataService>();
            ////}

            SimpleIoc.Default.Register<NinjaListViewModel>();



        }

        public MainViewModel Main
        {
            get
            {
                return ServiceLocator.Current.GetInstance<MainViewModel>();
            }
        }
        public NinjaListViewModel NinjaList
        {
            get
            {

                return ServiceLocator.Current.GetInstance<NinjaListViewModel>();
            }
        }
        public NinjaInventoryViewModel NinjaInventory
        {
            get
            {

                return new NinjaInventoryViewModel(this.NinjaList.SelectedNinja);
            }
        }
        public NinjaShopListViewModel NinjaShop
        {
            get
            {
                _shop = new NinjaShopListViewModel(this.NinjaList.SelectedNinja);
                return _shop;
            }
        }
        public EditNinjaViewModel EditNinjaVM
        {
            get
            {

                return new EditNinjaViewModel(this.NinjaList);
            }
        }
        public AddNinjaViewModel AddNinjaVM
        {
            get
            {

                return new AddNinjaViewModel(this.NinjaList);
            }
        }
        public AddItemViewModel AddItemVM
        {
            get
            {
                return new AddItemViewModel(this._shop);
            }
        }
        public EditItemViewModel EditItemVM
        {
            get
            {
                return new EditItemViewModel(this._shop);
            }
        }
        public static void Cleanup()
        {
            // TODO Clear the ViewModels
        }
    }
}