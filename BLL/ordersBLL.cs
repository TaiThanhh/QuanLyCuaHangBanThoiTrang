using ADO;
using DTO;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BLL
{
    public class ordersBLL
    {
        ordersDAL ordersDAL = new ordersDAL();
        public ordersBLL()
        {

        }

        public bool new_orders(int customerid, int employeeid, double total)
        {
            return ordersDAL.new_orders(customerid, employeeid, total);
        }
        public List<orders> Last_Id()
        {
            return ordersDAL.Last_Id();
        }

        public DataTable loadhoadon()
        {
            return ordersDAL.loadhoadon();
        }
        public DataTable timkiemhoadon(int id)
        {
            return ordersDAL.timkiemhoadon(id);
        }
        public DataTable HD_Thang(int year)
        {
            return ordersDAL.HD_Thang(year);
        }
        public DataTable loadHd_Online()
        {
            return ordersDAL.loadHd_Online();
        }
        public bool capnhatnhanvien(int orderid, int empid)
        {
            return ordersDAL.capnhatnhanvien(orderid, empid);
        }
        public DataTable loadhoadononline()
        {
            return ordersDAL.loadhoadononline();
        }
    }
}
