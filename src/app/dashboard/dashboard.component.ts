import { Component, OnInit } from '@angular/core';
import { ApiService } from '../api.service';
import { Customer } from '../customer';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {

  customer:  Customer[];
  selectedCustomer:  Customer  = { id :  null , name:null, phone_no:  null, email:  null};

  constructor(private apiService: ApiService) { }

  ngOnInit(): void {
    this.apiService.readCustomer().subscribe((customer: Customer[])=>{
      this.customer = customer;
      console.log(this.customer);
    })
  }

  createOrUpdateCustomer(form){
    if(this.selectedCustomer && this.selectedCustomer.id){
      form.value.id = this.selectedCustomer.id;
      this.apiService.updateCustomer(form.value).subscribe((customer: Customer)=>{
        console.log(customer);
        alert("Customer details updated");
      });
    }
    else{

      this.apiService.createCustomer(form.value).subscribe((customer: Customer)=>{
        console.log(customer);
        alert("Customer details created");
       
      });
    }

  }

  selectCustomer(customer: Customer){
    this.selectedCustomer = customer;
    console.log(customer);
    alert(JSON.stringify(customer));
  }

  // viewCustomer(customer: Customer){

  // }


  deleteCustomer(id){
    this.apiService.deleteCustomer(id).subscribe((customer: Customer)=>{
      console.log(customer);
      alert("Customer details deleted");
    });
  }
}
