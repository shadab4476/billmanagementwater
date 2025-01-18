<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shops Details</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f7fafc;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        section {
            max-width: 1200px;
            margin: auto;
        }

        tr {
            page-break-inside: avoid;
            /* Prevents rows from breaking across pages */

        }

        /* Table Styles */
        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            overflow: scroll;
            background-color: white;
            border: 1px solid #e5e7eb;
            border-collapse: collapse;
        }

        thead {
            display: table-header-group;
            /* Ensures the header repeats on every page */
        }

        tfoot {
            display: table-footer-group;
            /* Optional: Use for table footers */
        }


        th,
        td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #e5e7eb;
            border: 1px solid #ddd;
            padding: 8px;
            max-width: 150px;
            /* Adjust width based on your table design */
            overflow: hidden;
            word-wrap: break-word;
            white-space: normal;
            /* Allows text to wrap */

            /* Ensures long text wraps within cells */
        }

        th {
            background-color: #f3f4f6;
            color: #4b5563;
            font-weight: bold;
            text-transform: uppercase;
        }

        td {
            color: #374151;
        }


        /* Row Hover and Background Styles */
        tr:nth-child(even) {
            background-color: #f9fafb;
        }

        tr:hover {
            background-color: #f3f4f6;
        }

        /* Conditional Status Colors */
        .status-pending {
            color: #d97706;
        }

        .status-running {
            color: #16a34a;
        }

        .status-closed {
            color: #ef4444;
        }

        .status-unknown {
            color: #9ca3af;
        }

        /* Empty Row Message */
        .no-records {
            text-align: center;
            font-weight: bold;
            color: #16a34a;
        }
    </style>
</head>

<body>

    <section>

        {{-- <img src="http://localhost:8000/storage/assets/images/1736690693.jpg" alt=""> --}}
        <div class="table-container">
            <h1>Healthy Drinking Water </h1>
            <div class="header">
                <h2>Shops</h2>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Shop Status</th>
                        <th>Shop Name</th>
                        <th>Shop Address</th>
                        <th>Shop Description</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example row -->
                    @forelse ($shops as $shop)

                        <tr>
                            <td>{{ $shop->id ? $shop->id : '-' }}</td>
                            <td>{{ $shop->users->name ? $shop->users->name : '-' }}</td>
                            @forelse($isActive as $activeUser)
                                @if ($shop->id == $activeUser->id)
                                    <td
                                        class="{{ $activeUser->status == 0 ? 'status-pending' : ($activeUser->status == 1 ? 'status-running' : ($activeUser->status == 2 ? 'status-closed' : 'status-unknown')) }}">
                                        {{ $activeUser->status == 0 ? 'Pending' : ($activeUser->status == 1 ? 'Running' : ($activeUser->status == 2 ? 'Closed' : 'Unknown')) }}
                                    </td>
                                @endif
                            @empty
                                <td>-</td>
                            @endforelse
                            <td>{{ $shop->shop_name ? $shop->shop_name : '-' }}</td>
                            <td>{{ $shop->shop_address ? $shop->shop_address : '-' }}</td>
                            <td>{{ $shop->shop_description ? $shop->shop_description : '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="no-records">no record found..!!!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <b>Date: {{ \Carbon\Carbon::now()->toFormattedDateString() }}</div>
        </b>
    </section>

</body>

</html>
