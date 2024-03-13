using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace DTO
{
    public class cart
    {
        int id;
        int customerId;
        int productId;
        string size;
        int quantity;
        public int Id { get => id; set => id = value; }
        public int CustomerId { get => customerId; set => customerId = value; }
        public int ProductId { get => productId; set => productId = value; }
        public int Quantity { get => quantity; set => quantity = value; }
        public string Size { get => size; set => size = value; }

        public cart()
        {

        }

        public cart(DataRow row)
        {
            this.ProductId = Int32.Parse(row["ProductId"].ToString());
            this.Quantity = Int32.Parse(row["Quantity"].ToString());
            this.Size = row["Size"].ToString();
        }


    }
}
