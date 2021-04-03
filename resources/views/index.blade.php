<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>        <!-- Styles -->

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4 p-4">
        <a class="navbar-brand" href="#">App</a>
    </nav>

    <main role="main" class="container">
        <div class="jumbotron">
            <h1>Disbursement</h1>
            <div>
                <form>
                    <div class="form-group">
                        <label for="bankCode">Bank Code</label>
                        <input type="text" class="form-control" name="bank_code" placeholder="Bank Code" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="accountNumber">Account Number</label>
                        <input type="text" class="form-control" name="account_number" placeholder="Account Number" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="amount">Amount</label>
                        <input type="text" class="form-control" name="amount" placeholder="Amount" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="remark">Remark</label>
                        <input type="text" class="form-control" name="remark" placeholder="Remark" required>
                    </div>
                    <button class="btn btn-primary btn-block mt-2" type="button" onclick="submitForm()">Submit</button>
                </form>
            </div>
            <div class="mt-4">
                <div>
                    {{ $data->links() }}
                </div>
                <div class="table-responsive mt-8">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Action</th>
                            <th scope="col">ID</th>
                            <th scope="col">TimeStamp</th>
                            <th scope="col">Bank Acount</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Remark</th>
                            <th scope="col">Receipt</th>
                            <th scope="col">Time Served</th>
                            <th scope="col">Beneficiary Name</th>
                            <th scope="col">Fee</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <th>
                                        <button
                                            type="button"
                                            class="btn btn-primary"
                                            onclick="disbursementPost({{ $item->id }})"
                                        >Set Status</button>
                                </th>
                                <th scope="row">
                                    {{ $item->id }}
                                </th>
                                <td>
                                    {{ $item->timestamp }}
                                </td>
                                <td>
                                    {{ $item->bank_code }} -
                                    {{ $item->account_number }}
                                </td>
                                <td>
                                    {{ $item->amount }}
                                </td>
                                <td>
                                    {{ $item->status }}
                                </td>
                                <td>
                                    {{ $item->remark }}
                                </td>
                                <td>
                                    @if($item->receipt == 'PENDING')
                                        {{ $item->receipt }}
                                    @else
                                        <a href="{{ $item->receipt }}">
                                            <img src="{{ $item->receipt }}" alt="{{ $item->receipt }}" class="img-thumbnail">
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    {{ $item->time_served }}
                                </td>
                                <td>
                                    {{ $item->beneficiary_name }}
                                </td>
                                <td>
                                    {{ $item->fee }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-8">
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </main>

    </body>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        const disbursementPost = async (id) => {
            try {
                const response = await axios.get(`/v1/disburse/` + id);                
                alert('Success')
                location.reload();
                //open this console.log to show the response on console browser
                // console.log(response.data);

            } catch (errors) {
                alert('Error')
            }
        };

        const submitForm = async () => {
            try {
                let formData = new FormData()

                formData.append('bank_code', document.querySelector("input[name='bank_code']").value);
                formData.append('account_number', document.querySelector("input[name='account_number']").value);
                formData.append('amount', document.querySelector("input[name='amount']").value);
                formData.append('remark', document.querySelector("input[name='remark']").value);

                const response = await axios.post(`/v1/disburse`, formData);
                alert('Success')
                location.reload();
                //open this console.log to show the response on console browser
                // console.log(response.data);
            } catch (errors) {
                alert('Not Validate')
            }
        };
    </script>
</html>
