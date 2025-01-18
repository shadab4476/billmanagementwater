<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Maintenance Detail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        section {
            max-width: 800px;
            margin: auto;
            border: 1px solid black;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .maintenance-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .maintenance-tbody th,
        .maintenance-tbody td {
            border: 1px solid black;
            text-align: center;
            padding: 8px;
        }

        .maintenance-tbody th {
            font-weight: bold;
        }

        .maintenance-tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .amount-summary {
            border: 1px solid black;
            padding: 10px;
            margin-top: 20px;
            background-color: #f9f9f9;
        }

        .amount-summary h3 {
            margin: 0;
            padding: 5px 10px;
            border: 1px solid black;
        }

        .income {
            color: green;
        }

        .expense {
            color: red;
        }

        .total-amount {
            color: black;
        }

        .maintenance-tbody td.note {
            max-width: 200px;
            word-wrap: break-word;
        }

        .maintenance-table thead {
            background-color: #d8d8d8;
            font-size: 18px;
            border: 1px solid red color: rgb(34, 34, 34);
        }
    </style>
</head>

<body>
    <section>
        <h1>Healthy Drinking Water</h1>
        <p>Month: {{ $monthName }}</p>
        <table class="maintenance-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Note</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody class="maintenance-tbody">
                @auth
                    @role('superAdmin')
                        @forelse ($maintenances as $maintenance)
                            <tr>
                                <td>{{ $maintenance->id ? $maintenance->id : '-' }}</td>
                                <td>{{ $maintenance->users->name }}</td>
                                <td>
                                    <span style="font-weight: bold; color: {{ $maintenance->type == 1 ? 'green' : 'red' }};">
                                        {{ $maintenance->type == 1 ? 'Income' : 'Expense' }}
                                    </span>
                                </td>
                                <td>{{ $maintenance->amount ? $maintenance->amount : '-' }}</td>
                                <td class="note">
                                    {{ $maintenance->note ? $maintenance->note : '-' }}
                                </td>
                                <td>{{ $maintenance->date ? $maintenance->date : '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="font-weight: bold; color: green;">No record found..!!!</td>
                            </tr>
                        @endforelse
                    @endrole
                @endauth
            </tbody>
        </table>

        <div class="amount-summary">
            <h3 class="income">{{ $getAllMaintenance ? 'All' : $monthName }} Income: {{ $income }}</h3>
            <h3 class="expense">{{ $getAllMaintenance ? 'All' : $monthName }} Expense: {{ $expense }}</h3>
            <h3 class="total-amount">{{ $getAllMaintenance ? 'All' : $monthName }} Total Amount:
                {{ $totalAmount }} /-</h3>
        </div>
        <p> <strong>Generated On: {{ Date('Y-m-d') }} </strong></p>
    </section>
</body>

</html> 
