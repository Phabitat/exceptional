# Exceptional

Exception framework inspired by PHP's [SPL Exceptions](http://php.net/manual/en/spl.exceptions.php) with an extra touch of reality. Most of the time the challenge is not catching or logging  exceptions, but defining the right level of granularity, structuring and categorising them. Exceptional tries to solve this problem.

This project builds on a principle that the application throws an exception only for two reasons: either because user does something wrong or because the code does something wrong. As a result, there are two core classes: `ApplicationException` and `UserException`.

```
Exception

    ApplicationException                        Code does something bad.
        FunctionException                       Functions fails.
            MethodException                     Method fails.
                ArgumentException               Invalid method arguments.
                    ArgumentTypeException       Invalid argument type.
                    ArgumentValueException      Invalid argument value.
        ImplementationException                 Failing implementation.
            NotImplementedException             Block not yet implemented.

    UserException                               User does something bad.
        InputException                          Invalid input.
        ProtocolException                       Invalid operation over HTTP protocol.
            RequestException                    Invalid request, equivalent of 400.
                InputException                  Invalid request input.
                    ParameterException          Invalid parameter.
                    FileException               Invalid file.
                LocationException               Invalid location, equivalent of 404.
                MethodException                 Method is not allowed, equivalent of 405.
                ProtocolException               Invalid protocol (http/https).
```
