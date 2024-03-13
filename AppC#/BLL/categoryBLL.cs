using ADO;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BLL
{
    public class categoryBLL
    {
        categoryDAL categoryDAL = new categoryDAL();
        public categoryBLL()
        {

        }
        public DataTable loadCategory()
        {
            return categoryDAL.loadCategory();
        }

    }
}
