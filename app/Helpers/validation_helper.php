<?php

if (!function_exists('get_update_validation_rules')) {
    /**
     * Get validation rules for update operations
     * Automatically replaces {id} placeholder with actual ID
     */
    function get_update_validation_rules($model, $id)
    {
        $rules = $model->getValidationRules();
        
        // Replace {id} placeholder with actual ID for all rules
        foreach ($rules as $field => $rule) {
            if (strpos($rule, '{id}') !== false) {
                $rules[$field] = str_replace('{id}', $id, $rule);
            }
        }
        
        return $rules;
    }
}

if (!function_exists('get_unique_validation_rule')) {
    /**
     * Generate is_unique validation rule with proper ID exclusion
     */
    function get_unique_validation_rule($table, $field, $id = null)
    {
        if ($id !== null) {
            return "is_unique[{$table}.{$field},id,{$id}]";
        }
        return "is_unique[{$table}.{$field}]";
    }
}

if (!function_exists('build_validation_rules')) {
    /**
     * Build validation rules dynamically for create/update operations
     */
    function build_validation_rules($baseRules, $isUpdate = false, $id = null)
    {
        if (!$isUpdate) {
            return $baseRules;
        }
        
        $rules = $baseRules;
        
        // Update is_unique rules to exclude current record ID
        foreach ($rules as $field => $rule) {
            if (strpos($rule, 'is_unique[') !== false && $id !== null) {
                // Extract table.field from is_unique[table.field]
                preg_match('/is_unique\[([^\]]+)\]/', $rule, $matches);
                if (isset($matches[1])) {
                    $tableField = $matches[1];
                    // Replace the is_unique rule with ID exclusion
                    $rules[$field] = str_replace(
                        "is_unique[{$tableField}]",
                        "is_unique[{$tableField},id,{$id}]",
                        $rule
                    );
                }
            }
        }
        
        return $rules;
    }
}

if (!function_exists('validate_model_data')) {
    /**
     * Validate data using model rules with proper ID handling
     */
    function validate_model_data($controller, $model, $data, $id = null)
    {
        $isUpdate = ($id !== null);
        $rules = $model->getValidationRules();
        
        // Build proper validation rules
        $validationRules = build_validation_rules($rules, $isUpdate, $id);
        
        return $controller->validate($validationRules);
    }
}

if (!function_exists('get_user_validation_rules')) {
    /**
     * Get user validation rules for create/update
     */
    function get_user_validation_rules($id = null, $requirePassword = false)
    {
        $rules = [
            'username' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email',
            'role_id' => 'required|integer',
            'is_active' => 'in_list[false,true]'
        ];
        
        // Add unique validation
        $rules['username'] .= '|' . get_unique_validation_rule('users', 'username', $id);
        $rules['email'] .= '|' . get_unique_validation_rule('users', 'email', $id);
        
        
        // Add password validation if required
        if ($requirePassword) {
            $rules['password'] = 'required|min_length[6]';
            $rules['confirm_password'] = 'required|matches[password]';
        } elseif ($id !== null) {
            // For updates, password is optional
            $rules['password'] = 'permit_empty|min_length[6]';
            $rules['confirm_password'] = 'matches[password]';
        }
        
        return $rules;
    }
}

if (!function_exists('get_mahasiswa_validation_rules')) {
    /**
     * Get mahasiswa validation rules for create/update
     */
    function get_mahasiswa_validation_rules($id = null)
    {
        $currentYear = date('Y');
        
        $rules = [
            'nim' => 'required|min_length[3]|max_length[20]',
            'nama' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email',
            'jurusan' => 'required|in_list[Teknik Informatika,Sistem Informasi,Teknik Komputer,Teknik Elektro,Teknik Industri]',
            'angkatan' => "required|integer|greater_than[2014]|less_than_equal_to[{$currentYear}]"
        ];
        
        // Add unique validation
        $rules['nim'] .= '|' . get_unique_validation_rule('mahasiswa', 'nim', $id);
        $rules['email'] .= '|' . get_unique_validation_rule('mahasiswa', 'email', $id);
        
        return $rules;
    }
}

if (!function_exists('get_role_validation_rules')) {
    /**
     * Get role validation rules for create/update
     */
    function get_role_validation_rules($id = null)
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[50]',
            'display_name' => 'required|min_length[3]|max_length[100]',
            'description' => 'max_length[255]',
            'is_active' => 'in_list[false,true]'
        ];
        
        // Add unique validation
        $rules['name'] .= '|' . get_unique_validation_rule('roles', 'name', $id);
        
        return $rules;
    }
}

if (!function_exists('get_permission_validation_rules')) {
    /**
     * Get permission validation rules for create/update
     */
    function get_permission_validation_rules($id = null)
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[50]',
            'display_name' => 'required|min_length[3]|max_length[100]',
            'module' => 'required|max_length[50]',
            'description' => 'max_length[255]'
        ];
        
        // Add unique validation
        $rules['name'] .= '|' . get_unique_validation_rule('permissions', 'name', $id);
        
        return $rules;
    }
}

if (!function_exists('validate_with_custom_rules')) {
    /**
     * Validate request data with custom rules
     */
    function validate_with_custom_rules($controller, $rules)
    {
        if (!$controller->validate($rules)) {
            return back_with_validation_errors($controller->validator);
        }
        return true;
    }
}