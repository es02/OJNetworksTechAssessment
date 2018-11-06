<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Top 10 StackOverflow Questions</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Datatables -->
        <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>


        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .contentleft {
                text-align: left;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .img {
                height: 50px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div >
                    <div class="m-b-md title">Stack Overflow Top 10 Questions</div>
                    <table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" style="width:100%">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Posted By</th>
                                <th>Posted</th>
                                <th>Last Updated</th>
                                <th>Views</th>
                                <th>Answers</th>
                                <th>Tagged</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Title</th>
                                <th>Posted By</th>
                                <th>Posted</th>
                                <th>Last Updated</th>
                                <th>Views</th>
                                <th>Answers</th>
                                <th>Tagged</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                "ajax": {"url":"{{ request()->getSchemeAndHttpHost() }}/posts","dataSrc":""},
                "columns": [
                    {
                        "render": function ( data, type, row ) {
                            return '<a class="link" href="'+row['link']+'">'+row['title']+'</a>'+' (Post score: '+row['score']+')'
                        }
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<img class="img img-thumbnail rounded float-left" src="'+row['user_image']+'"><a class="link contentleft" href="'+row['user_link']+'">'+row['display_name']+'</a>'
                        }
                    },
                    {
                        data: "creation_date",
                        type: "date"
                    },
                    {
                        data: "last_activity_date",
                        type: "date"
                    },
                    { data: "view_count" },
                    { data: "answer_count" },
                    { data: "tags" }
                ]
            } );
        } );
    </script>
</html>
