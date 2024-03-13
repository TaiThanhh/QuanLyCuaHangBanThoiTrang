using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace DTO
{
    public class category
    {
        int id;
        string name;
        public int Id { get => id; set => id = value; }
        public string Name { get => name; set => name = value; }
        public category()
        {

        }

        public category(DataRow row)
        {
            this.Id = Int32.Parse(row["Id"].ToString());
            this.Name = row["Categry_Name"].ToString();
        }

 
    }
}
