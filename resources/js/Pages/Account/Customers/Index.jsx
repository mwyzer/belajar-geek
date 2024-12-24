// Import React  
import React from "react";

// Import Layout  
import LayoutAccount from '../../../Layouts/Account';

// Import Head, usePage, Link  
import { Head, usePage, Link } from '@inertiajs/react';

// Import permissions  
import hasAnyPermission from '../../../Utils/Permissions';

// Import component Search  
import Search from '../../../Shared/Search';

// Import component Pagination  
import Pagination from '../../../Shared/Pagination';

export default function CustomerIndex() {

    // Destructure props "customers"  
    const { customers } = usePage().props;

    return (
        <>
            <Head>
                <title>Customers - Geek Store</title>
            </Head>
            <LayoutAccount>
                <div className="row mt-5">
                    <div className="col-md-8">
                        <div className="row">
                            <div className="col-md-3 col-12 mb-2">
                                <Link href="/account/customers/create" className="btn btn-md btn-success border-0 shadow w-100" type="button">
                                    <i className="fa fa-plus-circle me-2"></i>
                                    Add Customer
                                </Link>
                            </div>
                            <div className="col-md-9 col-12 mb-2">
                                <Search URL={'/account/customers'} />
                            </div>
                        </div>
                    </div>
                </div>
                <div className="row mt-2 mb-4">
                    <div className="col-12">
                        <div className="card border-0 rounded shadow-sm border-top-success">
                            <div className="card-header">
                                <span className="font-weight-bold"><i className="fa fa-users"></i> Customers</span>
                            </div>
                            <div className="card-body">
                                <div className="table-responsive">
                                    <table className="table table-bordered table-striped table-hovered">
                                        <thead>
                                            <tr>
                                                <th scope="col" style={{ width: '5%' }}>No.</th>
                                                <th scope="col" style={{ width: '10%' }}>Registration Date</th>
                                                <th scope="col" style={{ width: '15%' }}>Name</th>
                                                <th scope="col" style={{ width: '15%' }}>WhatsApp Number</th>
                                                <th scope="col" style={{ width: '15%' }}>Telegram ID</th>
                                                <th scope="col" style={{ width: '10%' }}>Account Type</th>
                                                <th scope="col" style={{ width: '10%' }}>To WA PLGN</th>
                                                <th scope="col" style={{ width: '10%' }}>Total Deposit</th>

                                                <th scope="col" style={{ width: '15%' }}>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {customers.data.map((customer, index) => (
                                                <tr key={customer.id}>
                                                    <td className="text-center">{++index + (customers.current_page - 1) * customers.per_page}</td>
                                                    <td>{customer.registration_date ? new Date(customer.registration_date).toLocaleDateString() : 'N/A'}</td>
                                                    <td>{customer.name}</td>
                                                    <td>{customer.whatsapp_number}</td>
                                                    <td>{customer.telegram_id}</td>
                                                    <td>{customer.account_type}</td>
                                                    <td>{customer.wa_plgn}</td>
                                                    <td>{customer.total_deposit}</td>

                                                    <td className="text-center">
                                                        {hasAnyPermission(['customers.edit']) &&
                                                            <Link href={`/account/customers/${customer.id}/edit`} className="btn btn-primary btn-sm me-2">
                                                                <i className="fa fa-pencil-alt"></i>
                                                            </Link>
                                                        }
                                                        {hasAnyPermission(['customers.delete']) &&
                                                            <button className="btn btn-danger btn-sm">
                                                                <i className="fa fa-trash"></i>
                                                            </button>
                                                        }
                                                    </td>
                                                </tr>
                                            ))}
                                        </tbody>
                                    </table>
                                </div>
                                <Pagination links={customers.links} align={'end'} />
                            </div>
                        </div>
                    </div>
                </div>
            </LayoutAccount>
        </>
    );
}
