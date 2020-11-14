module "my-switch-case" {
    for_each = fileset("${path.module}/src", "./**")
    source = "github.com/lonnyantunes/terraform-provider-switch-case"
    
    # Expression to compare (related file extension from /src)
    expression = split(".",basename(each.value))[1] 
    
    # Cases to compare with expression
    cases = { 
        "sql" = {
            message = "This is a .sql file"
            content-type = "application/sql"
            filepath = each.value
        },
        "php" = {
            message = "This is a .php file"
            content-type =  "application/x-httpd-php"
            filepath = each.value
        },
        "png" = {
            message = "This is a .png file"
            content-type =  "image/png"
            filepath = each.value
        }
        
    }
}

output "result" {
    value = [for case in module.my-switch-case : "${case.result}"]
}