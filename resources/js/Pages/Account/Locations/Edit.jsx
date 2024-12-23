// Import React  
import React, { useState } from "react";

// Import layout  
import LayoutAccount from '../../../Layouts/Account';

// Import Head, usePage, router, and Link  
import { Head, usePage, router, Link } from '@inertiajs/react';

// Import SweetAlert  
import Swal from 'sweetalert2';

export default function Edit() {
    // Destructure props  
    const { location, errors } = usePage().props;

    // State for form fields  
    const [name, setName] = useState(location.name || "");
    const [address, setAddress] = useState(location.address || "");
    const [image, setImage] = useState(null);

    // Handle form submission  
    const handleUpdate = (e) => {
        e.preventDefault();

        // Create FormData to handle image upload  
        const formData = new FormData();
        formData.append('name', name);
        formData.append('address', address);
        if (image) {
            formData.append('image', image);
        }
        formData.append('_method', 'PUT'); // Specify PUT for Laravel

        // Send data via Inertia router  
        router.post(`/account/locations/${location.id}`, formData, {
            onSuccess: () => {
                Swal.fire({
                    title: 'Success!',
                    text: 'Location updated successfully!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    };

    return (
        <>
            <Head>
                <title>Edit Location - Geek Store</title>
            </Head>
            <LayoutAccount>
                <div className="row mt-4">
                    <div className="col-12">
                        <div className="card border-0 rounded shadow-sm border-top-success">
                            <div className="card-header">
                                <span className="font-weight-bold">
                                    <i className="fa fa-edit"></i> Edit Location
                                </span>
                            </div>
                            <div className="card-body">
                                <form onSubmit={handleUpdate}>
                                    {/* Location Name */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Location Name</label>
                                        <input 
                                            type="text" 
                                            className="form-control" 
                                            value={name} 
                                            onChange={(e) => setName(e.target.value)} 
                                            placeholder="Enter Location Name" 
                                        />
                                        {errors.name && (
                                            <div className="alert alert-danger">
                                                {errors.name}
                                            </div>
                                        )}
                                    </div>

                                    {/* Location Address */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Location Address</label>
                                        <input 
                                            type="text" 
                                            className="form-control" 
                                            value={address} 
                                            onChange={(e) => setAddress(e.target.value)} 
                                            placeholder="Enter Location Address" 
                                        />
                                        {errors.address && (
                                            <div className="alert alert-danger">
                                                {errors.address}
                                            </div>
                                        )}
                                    </div>

                                    {/* Location Image */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Location Image</label>
                                        <input 
                                            type="file" 
                                            className="form-control" 
                                            onChange={(e) => setImage(e.target.files[0])} 
                                        />
                                        {errors.image && (
                                            <div className="alert alert-danger">
                                                {errors.image}
                                            </div>
                                        )}
                                        {location.image && (
                                            <div className="mt-2">
                                                <img 
                                                    src={location.image} 
                                                    alt="Current Location Image" 
                                                    className="img-thumbnail" 
                                                    width="150"
                                                />
                                            </div>
                                        )}
                                    </div>

                                    {/* Actions */}
                                    <div>
                                        <button type="submit" className="btn btn-md btn-success me-2">
                                            <i className="fa fa-save"></i> Update
                                        </button>
                                        <Link href="/account/locations" className="btn btn-md btn-secondary">
                                            <i className="fa fa-arrow-left"></i> Back
                                        </Link>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </LayoutAccount>
        </>
    );
}
