import React, { useState } from 'react';
import { router } from '@inertiajs/react';

const CustomerCreate = () => {
    const [formData, setFormData] = useState({
        customerTitle: '',
        customerName: '',
        customerLocation: '',
        membershipLevelId: '',
    });

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData({ ...formData, [name]: value });
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        router.post(route('account.customers.store'), formData);
    };

    return (
        <form onSubmit={handleSubmit}>
            <h1>Create Customer</h1>
            <input name="customerTitle" onChange={handleChange} placeholder="Title" />
            <input name="customerName" onChange={handleChange} placeholder="Name" />
            <input name="customerLocation" onChange={handleChange} placeholder="Location" />
            <button type="submit">Save</button>
        </form>
    );
};

export default CustomerCreate;
