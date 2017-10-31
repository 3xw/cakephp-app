<%
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
%>

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
<% $belongsTo = $this->Bake->aliasExtractor($modelObj, 'BelongsTo'); %>
        $query = $this-><%= $currentModelName %>

<% if ($belongsTo): %>
        ->find('search',['search' => $this->request->query])
        ->contain([<%= $this->Bake->stringifyList($belongsTo, ['indent' => false]) %>]);
<% else: %>
        ->find('search',['search' => $this->request->query]);
<% endif; %>
        $this->set('<%= $pluralName %>', $this->paginate($query));
    }
