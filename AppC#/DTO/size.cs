using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace DTO
{
    public class size
    {
        int product_Id;
        string size_Name;
        int quantity;
        public int Product_Id { get => product_Id; set => product_Id = value; }
        public string Size_Name { get => size_Name; set => size_Name = value; }
        public int Quantity { get => quantity; set => quantity = value; }

        public size()
        {

        }

        public size(DataRow row)
        {
            this.Product_Id = Int32.Parse(row["Product_Id"].ToString());
            this.Size_Name = row["Size_Name"].ToString();
            this.Quantity = Int32.Parse(row["Quantity"].ToString());
        }


    }
}
