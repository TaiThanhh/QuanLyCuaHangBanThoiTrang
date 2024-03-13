using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace DTO
{
    public class products
    {
        double price;

        public double Price { get => price; set => price = value; }

        public products()
        {

        }

        public products(DataRow row)
        {
            this.Price = float.Parse(row["Price"].ToString());
        }
    }
}
