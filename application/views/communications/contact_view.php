<table class="wrapper" style="border-collapse: collapse;border-spacing: 0;background-color: #ffffff;width: 100%;min-width: 620px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;table-layout: fixed">
	<tbody>
		<tr>
			<td style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top">
				<center>
					<table class="header" style="border-collapse: collapse;border-spacing: 0;Margin-left: auto;Margin-right: auto;width: 560px">
						<tbody>
							<tr>
								<td style="padding-top: 20px;padding-bottom: 10px;padding-left: 0;padding-right: 0;vertical-align: top;color: #aaaaaa;font-size: 24px;font-family: Lucida Sans Unicode, arial, sans-serif" align="left">
									<center>
										<img style="Margin-left: auto;Margin-right: auto;border-left-width: 0;border-top-width: 0;border-bottom-width: 0;border-right-width: 0;-ms-interpolation-mode: bicubic;display: block;max-width: 150px;" src="<?=assets_url('images/template/brand-newsletter.png', TRUE);?>" alt="First Blades">
									</center>
								</td>
							</tr>
						</tbody>
					</table>
				</center>
			</td>
		</tr>
	</tbody>
</table>
<table class="wrapper" style="border-collapse: collapse;border-spacing: 0;background-color: #ffffff;width: 100%;min-width: 620px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;table-layout: fixed">
	<tbody>
		<tr>
			<td style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top">
				<center>
					<table class="one-col" style="border-collapse: collapse;border-spacing: 0;Margin-left: auto;Margin-right: auto;width: 600px">
						<tbody>
							<tr>
								<td class="column" style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top;text-align: left;color: #353638">
									<div>
										<div class="column-top" style="font-size: 20px;line-height: 20px">&nbsp;</div>
									</div>
									<table class="contents" style="border-collapse: collapse;border-spacing: 0;width: 100%">
										<tbody>
											<tr>
												<td class="padded" style="padding-top: 0;padding-bottom: 0;padding-left: 20px;padding-right: 20px;vertical-align: top">
													<h1 style="text-align: center;Margin-top: 0;color:#888;font-weight: bold;font-family: Open Sans, Roboto, Lucida Sans Unicode, arial, sans-serif;font-size: 24px;line-height: 42px;Margin-bottom: 24px; text-transform: uppercase;"><?=(!empty($topic_str)) ? $topic_str : 'Consulta web'?></h1>
												</td>
											</tr>
											<tr>
												<td class="padded" style="padding-top: 0;padding-bottom: 0;padding-left: 20px;padding-right: 20px;vertical-align: top;font-weight: 100;font-family: Open Sans, Roboto, Lucida Sans Unicode, arial, sans-serif;font-size: 16px;line-height: 1;">
													<table style="border-collapse: collapse;border-spacing: 0;width: 100%;margin-bottom:20px;">
														<tbody>
															<tr>
																<td style="vertical-align:top;" width="50%">
																	<span style="font-size: 13px;color:#666;">Nombre</span>
																	<p style="margin-top:5px"><?=(!empty($name)) ? $name : '(No especificado)'?></p>

																	<span style="font-size: 13px;color:#666;">Email</span>
																	<p style="margin-top:5px"><?=(!empty($email)) ? $email : '(No especificado)'?></p>

																	<span style="font-size: 13px;color:#666;">Empresa</span>
																	<p style="margin-top:5px"><?=(!empty($company)) ? $company : '(No especificado)'?></p>

																	<span style="font-size: 13px;color:#666;">Asunto</span>
																	<p style="margin-top:5px"><?=(!empty($subject)) ? $subject : '(No especificado)'?></p>

																	<span style="font-size: 13px;color:#666;">Mensaje</span>
																	<p style="margin-top:5px"><?=(!empty($message)) ? $message : '(No especificado)'?></p>
																	
																	<?php if(!empty($attachments)): ?>
																		<span style="font-size: 13px;color:#666;">Adjuntos</span>
																		<?php foreach($attachments as $attachment): ?>
																			<p style="margin-top:5px"><?=$attachment?></p>
																		<?php endforeach?>
																	<?php endif ?>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
									<div class="column-bottom" style="font-size: 40px;line-height: 40px">&nbsp;</div>
									<div class="column-bottom" style="font-size: 60px;line-height: 60px">&nbsp;</div>
								</td>
							</tr>
						</tbody>
					</table>
				</center>
			</td>
		</tr>
	</tbody>
</table>