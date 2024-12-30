import React from 'react';
import { Link, router } from '@inertiajs/react';

const CustomerIndex = ({ customers }) => {
    const handleDelete = (id) => {
        if (confirm('Are you sure you want to delete this customer?')) {
            router.delete(route('account.customers.destroy', id));
        }
    };

    return (
        <div>
            <h1>Customer List</h1>
            <Link href={route('account.customers.create')} className="btn btn-primary">Add Customer</Link>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {customers.data.map((customer, index) => (
                        <tr key={customer.id}>
                            <td>{index + 1}</td>
                            <td>{customer.customerTitle}</td>
                            <td>{customer.customerName}</td>
                            <td>{customer.customerLocation}</td>
                            <td>
                                <Link href={route('account.customers.edit', customer.id)} className="btn btn-warning">Edit</Link>
                                <button onClick={() => handleDelete(customer.id)} className="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
};

export default CustomerIndex;
