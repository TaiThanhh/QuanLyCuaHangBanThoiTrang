using DAL;
using DTO;
using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ADO
{
    public class categoryDAL
    {
        DBConnect dbconn = new DBConnect();
        public categoryDAL()
        {

        }
        public DataTable loadCategory()
        {
            DataTable dt_kh = new DataTable();
            string sqlselect = "SELECT * FROM `category`";
            dt_kh = dbconn.getDatatable(sqlselect, "dbo.category");
            return dt_kh;
        }

    }
}
