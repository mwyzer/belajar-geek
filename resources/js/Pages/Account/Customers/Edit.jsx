import React, { useState } from 'react';
import { router, usePage } from '@inertiajs/react';

const CustomerEdit = () => {
    const { customer } = usePage().props;

    const [formData, setFormData] = useState({
        customerTitle: customer.customerTitle || '',
        customerName: customer.customerName || '',
        customerLocation: customer.customerLocation || '',
        membershipLevelId: customer.membershipLevelId || '',
    });

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData({ ...formData, [name]: value });
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        router.put(route('account.customers.update', customer.id), formData);
    };

    return (
        <form onSubmit={handleSubmit}>
            <h1>Edit Customer</h1>
            <div>
                <label>Title</label>
                <input 
                    name="customerTitle" 
                    value={formData.customerTitle} 
                    onChange={handleChange} 
                    placeholder="Title"
                />
            </div>
            <div>
                <label>Name</label>
                <input 
                    name="customerName" 
                    value={formData.customerName} 
                    onChange={handleChange} 
                    placeholder="Name"
                />
            </div>
            <div>
                <label>Location</label>
                <input 
                    name="customerLocation" 
                    value={formData.customerLocation} 
                    onChange={handleChange} 
                    placeholder="Location"
                />
            </div>
            <div>
                <label>Membership Level ID</label>
                <input 
                    name="membershipLevelId" 
                    value={formData.membershipLevelId} 
                    onChange={handleChange} 
                    placeholder="Membership Level ID"
                />
            </div>
            <button type="submit">Update</button>
        </form>
    );
};

export default CustomerEdit;
