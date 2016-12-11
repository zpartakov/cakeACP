<div class="tblCustomers form">
<?php echo $this->Form->create('TblCustomer');?>
	<fieldset>
 		<legend><?php __('Nouvelle adresse Cocagnard/e/s (commandes)'); ?></legend>
	<select id="TblCustomerPersPDDDistrNo" name="data[TblCustomer][PersPDDDistrNo]" >
	<?php
	
	#do and check sql
//request on pdds
$pdd="SELECT * FROM jos_pdds ORDER BY PDDTexte";
#do and check sql
	$sql=mysql_query($pdd);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}
	
	$i=0;
	while($i<mysql_num_rows($sql)){
		echo "<option value=\"" .mysql_result($sql,$i,'id') ."\">" .mysql_result($sql,$i,'PDDTexte')."</option>";
		$i++;
		}
	
	?>
	</select>
	<table> 
	<tr><td>

	<?php
			echo $this->Form->input('type_part');
		echo "<br>";
		#echo $this->Form->input('PersPDDDistrNo');
		
		
		echo $this->Form->input('PersNom', array('type'=>'text', 'style'=>'width: 300px;'));
		?>
		</td><td>
		<?
		echo $this->Form->input('PersPrenom', array('type'=>'text', 'style'=>'width: 300px;'));
	?>
</td>	</tr><tr>
<td>	<?
		echo $this->Form->input('PersAdresse');
				?>
		<p>
	<?
		echo $this->Form->input('PersNPA', array('type'=>'text', 'style'=>'width: 300px;'));
				?>		
		</p>
		<p>
					<?
		echo $this->Form->input('PersLocalite', array('type'=>'text', 'style'=>'width: 300px;'));
	?>
		</p>
		
		</td>
		
		
		
		<td>
		<?
		echo $this->Form->input('PersTelephone', array('type'=>'text', 'style'=>'width: 300px;'));
	?>
	<p>
			<?
		echo $this->Form->input('PersAdresseEmail');
		#echo $this->Form->input('jos_user_id');
	?>
	</p>
	<p>
			<div class="input textarea required"><label for="TblCustomerPersAdresse">ID (Identifiant) Joomla</label>
	<input type="texte" id="TblCustomerJosUserId" name="data[TblCustomer][jos_user_id]">
	</fieldset>
	</p>
	</td>
	</tr>
	</table>
	
<?php echo $this->Form->end(__('Ajouter', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Tbl Customers', true), array('action' => 'index'));?></li>
	</ul>
</div>
