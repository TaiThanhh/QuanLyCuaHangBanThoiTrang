using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Runtime.InteropServices;
using System.Text;
using System.Threading.Tasks;

namespace DTO
{
    public class orders
    {
        int id;
        public int Id { get => id; set => id = value; }

        public orders()
        {

        }

        public orders(DataRow row)
        {
            this.Id = int.Parse(row["Id"].ToString());
        }
    }
}
