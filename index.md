## Usage
```
# Expression to compare
variable "fruit" {
    default = "apple"
}

# Cases to compare with expression
variable "fruits" {
    default = {
        "apple" = {
            message = "Apple is selected"
        },
        "orange" = {
            message = "Orange is selected"
        },
        "strawberry" = {
            message = "Strawberry is selected"
        }
    }
}

# Module do switch-case for you
module "my-switch-case" {
    source = "github.com/lonnyantunes/terraform-provider-switch-case"
    expression = var.fruit
    cases = var.fruits
}

# It returns a result
output "selected_fruit" {
    value = module.my-switch-case.result.message
}
```

## Inputs

| Name          | Description |  Type 	                             |  Default 	| Required  |
|:---	        |:---	      |:---	                                 |:---	        |:---	    |
| expression  	| The string that you want to compare with your different cases of strings 	      |  `string`  	                         | ""             | Yes       |
| cases  	    | The strings you want to compare with the provided expression	      | `map(object({ message = string }))`  	                         | <pre>{ <br>  "" = {<br>         error = "You have to write and set your custom cases." <br>  } <br>}</pre>            | Yes       |


## Outputs
| Name          | Description |
|:---	        |:---	      |
| result  	    | Return the object matching your expression      |
