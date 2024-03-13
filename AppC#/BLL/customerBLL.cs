using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using ADO;
using DAL;
using DTO;
using MySql.Data.MySqlClient;

namespace BLL
{
    public class customerBLL
    {
        customerDAL customerDAL= new customerDAL();
        public customerBLL()
        {

        }
        public DataTable loadKHTheoSDT()
        {
            return customerDAL.loadKHTheoSDT();
        }

        public List<customer> Thongtin1kh(string SDT)
        {
            return customerDAL.Thongtin1kh(SDT);
        }

        public bool ThemKH(string name, string phone)
        {
            return customerDAL.ThemKH(name, phone);
        }
        public DataTable loadKhachHang()
        {
            return customerDAL.loadKhachHang();
        }
        public bool KT_email(string email)
        {
            return customerDAL.KT_email(email);
        }
        public bool them_khachhang(string ten, string email, string phone)
        {
            return customerDAL.them_khachhang(ten, email, phone);
        }

        public bool sua_khachhang(string ten, string email, string phone, int makh)
        {
            return customerDAL.sua_khachhang(ten, email, phone, makh);
        }

        public bool xoa_khachhang(int makh)
        {
            return customerDAL.xoa_khachhang(makh);
        }
    }
}
