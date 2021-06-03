import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Customer } from  './customer';
import { Observable } from  'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ApiService {

  PHP_API_SERVER = "http://127.0.0.1:8888/angular-rest-api/backend";
  
  constructor(private httpClient: HttpClient) { }

  readCustomer(): Observable<Customer[]>{
    return this.httpClient.get<Customer[]>(`${this.PHP_API_SERVER}/customer/read.php`);
  }

  createCustomer(customer: Customer): Observable<Customer>{
    return this.httpClient.post<Customer>(`${this.PHP_API_SERVER}/customer/create.php`, customer);
  }

  updateCustomer(customer: Customer){
    return this.httpClient.put<Customer>(`${this.PHP_API_SERVER}/customer/update.php`, customer);   
  }

  deleteCustomer(id: number){
    return this.httpClient.delete<Customer>(`${this.PHP_API_SERVER}/customer/delete.php/?id=${id}`);
  }
}
