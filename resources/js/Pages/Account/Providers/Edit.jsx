export default function Edit() {
    const { provider, locations, errors } = usePage().props;
    
    // State declarations
    const [name, setName] = useState(provider.name || '');
    const [type, setType] = useState(provider.type || '');
    const [providerName, setProviderName] = useState(provider.provider || '');
    const [number, setNumber] = useState(provider.number || '');
    const [position, setPosition] = useState(provider.position || '');
    const [owner, setOwner] = useState(provider.owner || '');
    const [status, setStatus] = useState(provider.status || '');
    const [loadBalance, setLoadBalance] = useState(provider.load_balance || '');

    const handleUpdate = (e) => {
        e.preventDefault();
        
        router.post(`/account/providers/${provider.id}`, {
            name,
            type,
            provider: providerName,
            number,
            position,
            owner,
            status,
            load_balance: loadBalance,
            _method: 'PUT'
        }, {
            onSuccess: () => {
                Swal.fire({
                    title: 'Success!',
                    text: 'Provider updated successfully!',
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
                <title>Edit Provider - Geek Store</title>
            </Head>
            <LayoutAccount>
                <div className="row mt-4">
                    <div className="col-12">
                        <div className="card border-0 rounded shadow-sm border-top-success">
                            <div className="card-header">
                                <span className="font-weight-bold">
                                    <i className="fa fa-edit"></i> Edit Provider
                                </span>
                            </div>
                            <div className="card-body">
                                <form onSubmit={handleUpdate}>
                                    {/* Name field */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Name</label>
                                        <input
                                            type="text"
                                            value={name}
                                            onChange={(e) => setName(e.target.value)}
                                            className="form-control"
                                        />
                                    </div>

                                    {/* Type field */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Type</label>
                                        <input
                                            type="text"
                                            value={type}
                                            onChange={(e) => setType(e.target.value)}
                                            className="form-control"
                                        />
                                    </div>

                                    {/* Provider field */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Provider</label>
                                        <input
                                            type="text"
                                            value={providerName}
                                            onChange={(e) => setProviderName(e.target.value)}
                                            className="form-control"
                                        />
                                    </div>

                                    {/* Number field */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Number</label>
                                        <input
                                            type="text"
                                            value={number}
                                            onChange={(e) => setNumber(e.target.value)}
                                            className="form-control"
                                        />
                                    </div>

                                    {/* Position field */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Position</label>
                                        <input
                                            type="text"
                                            value={position}
                                            onChange={(e) => setPosition(e.target.value)}
                                            className="form-control"
                                        />
                                    </div>

                                    {/* Owner field */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Owner</label>
                                        <input
                                            type="text"
                                            value={owner}
                                            onChange={(e) => setOwner(e.target.value)}
                                            className="form-control"
                                        />
                                    </div>

                                    {/* Status field */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Status</label>
                                        <select
                                            value={status}
                                            onChange={(e) => setStatus(e.target.value)}
                                            className="form-select"
                                        >
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>

                                    {/* Load Balance field */}
                                    <div className="mb-3">
                                        <label className="form-label fw-bold">Load Balance</label>
                                        <input
                                            type="text"
                                            value={loadBalance}
                                            onChange={(e) => setLoadBalance(e.target.value)}
                                            className="form-control"
                                        />
                                    </div>

                                    {/* Action buttons */}
                                    <div>
                                        <button type="submit" className="btn btn-md btn-success me-2">
                                            <i className="fa fa-save"></i> Update
                                        </button>
                                        <Link href="/account/providers" className="btn btn-md btn-secondary">
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